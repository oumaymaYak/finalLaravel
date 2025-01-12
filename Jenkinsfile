pipeline {
    agent any
    
    environment {
        DOCKERHUB_CREDENTIALS = credentials('dockerhub')
        DOCKER_IMAGE = "votre-username/laravel-app"
        DOCKER_TAG = "${BUILD_NUMBER}"
    }
    
    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    // Construction de l'image Docker
                    sh "docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} ."
                    
                    // Tag latest
                    sh "docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                }
            }
        }
        
        stage('Security Scan') {
            steps {
                script {
                    // Installation de Trivy si nécessaire
                    sh '''
                        if ! command -v trivy &> /dev/null; then
                            wget -qO - https://aquasecurity.github.io/trivy-repo/deb/public.key | apt-key add -
                            echo "deb https://aquasecurity.github.io/trivy-repo/deb $(lsb_release -sc) main" | tee -a /etc/apt/sources.list.d/trivy.list
                            apt-get update
                            apt-get install -y trivy
                        fi
                    '''
                    
                    // Scan de l'image avec Trivy
                    sh "trivy image --exit-code 1 --severity HIGH,CRITICAL ${DOCKER_IMAGE}:${DOCKER_TAG}"
                }
            }
        }
        
        stage('Push to DockerHub') {
            steps {
                script {
                    // Connexion à DockerHub
                    sh "echo ${DOCKERHUB_CREDENTIALS_PSW} | docker login -u ${DOCKERHUB_CREDENTIALS_USR} --password-stdin"
                    
                    // Push des images
                    sh "docker push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    sh "docker push ${DOCKER_IMAGE}:latest"
                }
            }
        }
        
        stage('Cleanup') {
            steps {
                // Nettoyage des images locales
                sh "docker rmi ${DOCKER_IMAGE}:${DOCKER_TAG}"
                sh "docker rmi ${DOCKER_IMAGE}:latest"
                
                // Déconnexion de DockerHub
                sh "docker logout"
            }
        }
    }
    
    post {
        always {
            // Nettoyage de l'espace de travail
            cleanWs()
        }
        success {
            echo 'Pipeline exécuté avec succès !'
        }
        failure {
            echo 'Le pipeline a échoué.'
        }
    }
}