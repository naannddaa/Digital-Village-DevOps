node {

    checkout scm

    // deploy env dev
    stage("Build") {
        docker.image('composer:2').inside('-u root') {

            sh 'rm composer.lock'
            sh 'composer install --no-interaction --prefer-dist --ignore-platform-reqs --no-scripts'

        }
    }

    // Testing
    docker.image('ubuntu').inside('-u root') {

        sh 'echo "Ini adalah test"'

    }

}
