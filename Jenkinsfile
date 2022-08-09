pipeline{
    agent { label 'api-node' }
    environment {
        REPO_NAME = 'crypto-pets-api'

        // static
        APACHE_DIR = '/var/www/html'
        SNYK_ID = 'lcube-snyk-token'
        JK_WORKSPACE = '/var/www/jenkins/workspace'
    }
    
    stages{
        stage("build") {
            steps {
                echo "building the application on ${NODE_NAME}."
                slackSend color: "good", message: "Starting build process for ${REPO_NAME} on ${BRANCH_NAME}."
                sh "if [ ! -d ${APACHE_DIR}/${BRANCH_NAME}/${REPO_NAME}/ ]; then mkdir -p ${APACHE_DIR}/${BRANCH_NAME}/${REPO_NAME}/; fi"
                sh "rsync -uqr --delete-during ${JK_WORKSPACE}/${REPO_NAME}_${BRANCH_NAME}/ ${APACHE_DIR}/${BRANCH_NAME}/${REPO_NAME}/"
            }
        }
        stage("test") {
            steps {
                echo 'Scanning the code..'
                slackSend color: "good", message: "Scanning code for ${REPO_NAME} on ${BRANCH_NAME}."
                // snykSecurity(
                //     snykInstallation: 'snyk-latest',
                //     snykTokenId: "${SNYK_ID}",
                //     failOnIssues: "false",
                // )
            }
        }
        stage("deploy") {
            steps {
                echo 'deploying the application..'
                slackSend color: "good", message: "Jenkins finish building & scanning ${REPO_NAME} on ${BRANCH_NAME}."
            }
        }
    }
}