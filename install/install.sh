# Execute certaines commandes après obtention des sources
#
# ===================================================================
# Variables à configurer
export BASE_URL="http://localhost/citemplate_bb"
export BASE_URL_PATTERN='http://localhost/citemplate/'

# User ID of the WEB server
export WEB_SERVER_ID=""

# Directory where GVV has been fetched
export PROJECT_DIR="/var/www/html/citemplate_bb"

# Not changes required below this line
# ===================================================================
# Configure BASE_URL

export CONFIG_FILE="$PROJECT_DIR/application/config/config.php"
echo "Configuration"
echo "    BASE_URL=$BASE_URL"
echo "    CONFIG_FILE=$CONFIG_FILE"

# Vérifie les droits d'écriture
#sed s|$BASE_URL_PATTERN|$BASE_URL| $CONFIG_FILE > $CONFIG_FILE
sed -i s#http://localhost/citemplate#http://localhost/citemplate_bb# $CONFIG_FILE 

# Nettoyage des répertoires

# Vérification des droits
chmod a+w $PROJECT_DIR/application/config/program.php

chmod 777 $PROJECT_DIR/application/logs
