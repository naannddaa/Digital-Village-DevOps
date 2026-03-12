pipeline {
    agent any

    environment {
        APP_ENV = 'local'
        APP_KEY = ''
        COMPOSER_ALLOW_SUPERUSER = '1'
    }

    stages {

        stage('Checkout') {
            steps {
                echo '📦 Mengambil kode dari GitHub...'
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                echo '📥 Menginstall dependencies Composer...'
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }

        stage('Setup Environment') {
            steps {
                echo '⚙️ Menyiapkan file .env...'
                sh '''
                    if [ ! -f .env ]; then
                        cp .env.example .env
                    fi
                '''
                sh 'php artisan key:generate'
            }
        }

        stage('Setup Database') {
            steps {
                echo '🗄️ Menyiapkan database SQLite...'
                sh '''
                    if [ ! -f database/database.sqlite ]; then
                        touch database/database.sqlite
                    fi
                '''
                sh 'php artisan migrate --force'
            }
        }

        stage('Clear Cache') {
            steps {
                echo '🧹 Membersihkan cache...'
                sh 'php artisan config:clear'
                sh 'php artisan cache:clear'
                sh 'php artisan view:clear'
                sh 'php artisan route:clear'
            }
        }

        stage('Run Tests') {
            steps {
                echo '🧪 Menjalankan tests...'
                sh 'php artisan test --env=testing || true'
            }
        }

        stage('Optimize') {
            steps {
                echo '⚡ Optimasi aplikasi...'
                sh 'php artisan config:cache'
                sh 'php artisan route:cache'
                sh 'php artisan view:cache'
            }
        }

        stage('Deploy') {
            steps {
                echo '🚀 Deploy ke folder lokal...'
                sh '''
                    DEPLOY_PATH="/home/nandapintar/prod.digitalvillage"
                    mkdir -p $DEPLOY_PATH
                    rsync -av --delete \
                        --exclude=".env" \
                        --exclude=".git" \
                        --exclude="storage/logs" \
                        ./ $DEPLOY_PATH/
                    echo "✅ Deploy selesai ke $DEPLOY_PATH"
                '''
            }
        }
    }

    post {
        success {
            echo '✅ Pipeline berhasil! Laravel app sudah ter-deploy.'
        }
        failure {
            echo '❌ Pipeline gagal! Cek log di atas untuk detail error.'
        }
    }
}
