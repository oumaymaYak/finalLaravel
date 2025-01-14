# Application E-commerce de Produits Cosmétiques avec Laravel
    **Description**
Une application full stack Laravel de vente en ligne de produits cosmétiques, intégrant Docker, Jenkins et Kubernetes pour un déploiement moderne et automatisé.
    **Technologies Utilisées**

Laravel 10.x
PHP 8.1
MySQL 8.0
Docker & Docker Compose
Jenkins
Kubernetes (Minikube)
Nginx
ArgoCD

**Prérequis**

Docker Desktop
Git
Jenkins
Minikube
kubectl
ArgoCD

**Installation**
1. Configuration Locale
Cloner le projet
```bash git clone https://github.com/oumaymaYak/finalLaravel.git
cd finalLaravel```

# Installer les dépendances
composer install
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate
2. Docker
bashCopy# Construire et démarrer les conteneurs
docker-compose up -d --build

# Vérifier les services
docker-compose ps
3. Jenkins Pipeline
Le pipeline Jenkins inclut :

Build de l'image Docker
Scan des vulnérabilités avec Trivy
Push vers Docker Hub

**Configuration:**

Accédez à Jenkins (http://localhost:8080)
Créez les credentials DockerHub (ID: 'dockerhub')
Créez un nouveau pipeline pointant vers le Jenkinsfile

**4. Kubernetes (Minikube)**
bashCopy# Démarrer Minikube
minikube start

# Appliquer les configurations
kubectl apply -f k8s/

# Vérifier le déploiement
kubectl get pods
kubectl get services
Structure du Projet
CopyfinalLaravel/
├── app/                 # Code source Laravel
├── database/           # Migrations et seeders
├── k8s/               # Manifestes Kubernetes
├── nginx/             # Configuration nginx
├── Dockerfile         # Build de l'application
└── docker-compose.yml # Configuration services
**Déploiement**
Pipeline CI/CD

**1.Build**

Construction de l'image Docker
Tests unitaires et d'intégration


**Security Scan**

Analyse avec Trivy
Vérification des vulnérabilités


**Push**

Publication sur DockerHub
Tagging des versions



ArgoCD
bashCopy# Installation
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml

# Synchronisation
argocd app sync monapp-cosmetique
Maintenance
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
Dépannage
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



**Sécurité**

Utilisation des secrets Kubernetes
Configuration des network policies
Limitation des accès aux ressources
Mises à jour régulières des dépendances
Scans de sécurité périodiques

**Contact**

Ouamayma Yakoubi
GitHub : oumaymaYak
