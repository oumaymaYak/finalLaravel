Application E-commerce de Produits Cosmétiques avec Laravel
Show Image
Show Image
Show Image
Show Image
Show Image
📖 Description
Une application full stack Laravel de vente en ligne de produits cosmétiques, intégrant Docker, Jenkins et Kubernetes pour un déploiement moderne et automatisé.
🚀 Technologies Utilisées

Backend :

Laravel 10.x
PHP 8.1
MySQL 8.0


DevOps :

Docker & Docker Compose
Jenkins
Kubernetes (Minikube)
Nginx
ArgoCD



📋 Prérequis

Docker Desktop
Git
Jenkins
Minikube
kubectl
ArgoCD

🔧 Installation
Configuration Locale
bashCopy# Cloner le projet
git clone https://github.com/oumaymaYak/finalLaravel.git
cd finalLaravel

# Installer les dépendances
composer install
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate
Docker
bashCopy# Construire et démarrer les conteneurs
docker-compose up -d --build

# Vérifier les services
docker-compose ps
Jenkins Pipeline
Configuration requise :

Accédez à Jenkins (http://localhost:8080)
Créez les credentials DockerHub (ID: 'dockerhub')
Créez un nouveau pipeline pointant vers le Jenkinsfile

Le pipeline inclut :

Build de l'image Docker
Scan des vulnérabilités avec Trivy
Push vers Docker Hub

Kubernetes (Minikube)
bashCopy# Démarrer Minikube
minikube start

# Appliquer les configurations
kubectl apply -f k8s/

# Vérifier le déploiement
kubectl get pods
kubectl get services
📁 Structure du Projet
CopyfinalLaravel/
├── app/                 # Code source Laravel
├── database/           # Migrations et seeders
├── k8s/               # Manifestes Kubernetes
├── nginx/             # Configuration nginx
├── Dockerfile         # Build de l'application
└── docker-compose.yml # Configuration services
🚀 Déploiement
Pipeline CI/CD

Build

Construction de l'image Docker
Tests unitaires et d'intégration


Security Scan

Analyse avec Trivy
Vérification des vulnérabilités


Push

Publication sur DockerHub
Tagging des versions



ArgoCD
bashCopy# Installation
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml

# Synchronisation
argocd app sync monapp-cosmetique
🔍 Maintenance
Logs et Monitoring
bashCopy# Logs applicatifs
kubectl logs -f deployment/laravel

# Surveillance des services
kubectl get pods --watch
Mises à jour
bashCopy# Application
git pull origin main
docker-compose build
docker-compose up -d

# Kubernetes
kubectl apply -f k8s/
Sauvegardes
bashCopy# Base de données
kubectl exec -it [pod-mysql] -- mysqldump -u root -p[password] database > backup.sql

# Volumes persistants
kubectl get pv -o yaml > pv-backup.yaml
🔧 Dépannage
Problèmes courants

Erreur de connexion Base de données

Vérifier les credentials dans .env
Vérifier les services Kubernetes


Erreur de build Docker

Vérifier les permissions
Nettoyer le cache : docker system prune


Pod en CrashLoopBackOff

Vérifier les logs : kubectl logs [pod-name]
Vérifier les ressources disponibles



🔒 Sécurité

Utilisation des secrets Kubernetes
Configuration des network policies
Limitation des accès aux ressources
Mises à jour régulières des dépendances
Scans de sécurité périodiques

📄 Licence
Ce projet est sous licence MIT
📞 Contact

Ouamayma Yakoubi
GitHub : oumaymaYak
