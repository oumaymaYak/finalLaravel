pipeline {
    agent any

    environment {
        DOCKER_PATH = 'docker'
        DOCKERHUB_CREDENTIALS = credentials('dockerhub')
        DOCKER_IMAGE = "oumaymayak/laravel-app"
        DOCKER_TAG = "${BUILD_NUMBER}"
    }
    
    stages {
        stage('Check Environment') {
            steps {
                script {
                    sh 'ls -la'
                    sh "${DOCKER_PATH} --version"
                    sh '[ -f Dockerfile ] && echo "Dockerfile found" || (echo "Dockerfile missing" && exit 1)'
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    echo "Starting Docker build..."
                    sh """
                        ${DOCKER_PATH} build -t ${DOCKER_IMAGE}:${DOCKER_TAG} .
                        ${DOCKER_PATH} tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest
                    """
                    echo "Docker build completed"
                }
            }
        }
        
        stage('Security Scan') {
            steps {
                script {
                    echo "Starting Trivy security scan..."
                    sh """
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
                        sh "echo \$DOCKERHUB_PASSWORD | ${DOCKER_PATH} login -u \$DOCKERHUB_USERNAME --password-stdin"
                    }
                    sh """
                        ${DOCKER_PATH} push ${DOCKER_IMAGE}:${DOCKER_TAG}
                        ${DOCKER_PATH} push ${DOCKER_IMAGE}:latest
                    """
                }
            }
        }
        
        stage('Cleanup') {
            steps {
                script {
                    sh """
                        ${DOCKER_PATH} rmi ${DOCKER_IMAGE}:${DOCKER_TAG}
                        ${DOCKER_PATH} rmi ${DOCKER_IMAGE}:latest
                        ${DOCKER_PATH} logout
                    """
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