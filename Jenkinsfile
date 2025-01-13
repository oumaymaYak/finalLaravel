pipeline {
    agent any
    
    environment {
        DOCKER_PATH = '"C:\\Program Files\\Docker\\Docker\\resources\\bin\\docker.exe"'
        DOCKERHUB_CREDENTIALS = credentials('dockerhub')
        DOCKER_IMAGE = "oumaymayak/laravel-app"
        DOCKER_TAG = "${BUILD_NUMBER}"
    }
    
    stages {
        stage('Check Environment') {
            steps {
                script {
                    bat 'dir'
                    bat "${DOCKER_PATH} --version"
                    bat 'if exist Dockerfile (echo Dockerfile found) else (echo Dockerfile missing && exit 1)'
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    echo "Starting Docker build..."
                    bat "${DOCKER_PATH} build -t ${DOCKER_IMAGE}:${DOCKER_TAG} ."
                    bat "${DOCKER_PATH} tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                    echo "Docker build completed"
                }
            }
        }
        
        stage('Security Scan') {
            steps {
                script {
                    echo "Starting Trivy security scan..."
                    bat """
                        docker run --rm \
                        -v /var/run/docker.sock:/var/run/docker.sock \
                        aquasec/trivy image ${DOCKER_IMAGE}:${DOCKER_TAG} \
                        --severity HIGH,CRITICAL
                    """
                }
            }
        }
        
        stage('Push to DockerHub') {
            steps {
                script {
                    withCredentials([usernamePassword(credentialsId: 'dockerhub', 
                                                    usernameVariable: 'DOCKERHUB_USERNAME', 
                                                    passwordVariable: 'DOCKERHUB_PASSWORD')]) {
                        bat "echo %DOCKERHUB_PASSWORD%| ${DOCKER_PATH} login -u %DOCKERHUB_USERNAME% --password-stdin"
                    }
                    bat "${DOCKER_PATH} push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    bat "${DOCKER_PATH} push ${DOCKER_IMAGE}:latest"
                }
            }
        }
        
        stage('Cleanup') {
            steps {
                script {
                    bat "${DOCKER_PATH} rmi ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    bat "${DOCKER_PATH} rmi ${DOCKER_IMAGE}:latest"
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
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}