pipeline {
    agent any
    
    environment {
        DOCKER_PATH = "C:\\Program Files\\Docker\\Docker\\resources\\bin\\docker.exe"
        DOCKERHUB_CREDENTIALS = credentials('dockerhub')
        DOCKER_IMAGE = "oumaymayak/laravel-app"
        DOCKER_TAG = "${BUILD_NUMBER}"
    }
    
    stages {
        stage('Check Docker') {
            steps {
                script {
                    bat "${DOCKER_PATH} --version"
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    // Construction de l'image Docker
                    bat "${DOCKER_PATH} build -t ${DOCKER_IMAGE}:${DOCKER_TAG} ."
                    bat "${DOCKER_PATH} tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                }
            }
        }
        
        stage('Push to DockerHub') {
            steps {
                script {
                    // Connexion à DockerHub
                    bat "echo %DOCKERHUB_CREDENTIALS_PSW%| ${DOCKER_PATH} login -u %DOCKERHUB_CREDENTIALS_USR% --password-stdin"
                    
                    // Push des images
                    bat "${DOCKER_PATH} push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    bat "${DOCKER_PATH} push ${DOCKER_IMAGE}:latest"
                }
            }
        }
        
        stage('Cleanup') {
            steps {
                script {
                    // Nettoyage des images locales
                    bat "${DOCKER_PATH} rmi ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    bat "${DOCKER_PATH} rmi ${DOCKER_IMAGE}:latest"
                    
                    // Déconnexion de DockerHub
                    bat "${DOCKER_PATH} logout"
                }
            }
        }
    }
    
    post {
        always {
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