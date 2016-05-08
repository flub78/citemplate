# Execute certaines commandes après obtention des sources
#
# Le but est de configurer les droits sur les répertoires,
# l'URL de base du site ainsi que tout ce qui est nécéssaire
# pour que l'installation ne rapporte pas d'erreur.
#
# Il est possible de modifier la section suivante ou de définir
# les variables d'environement avant d'executer le script.
#
# Exemple:
# export BASE_URL="https://flub78.ddns.net/citemplate"
# export PROJECT_DIR="$HOME/git/citemplate"
# ===================================================================
# Variables à configurer

if [ ! -n "${BASE_URL+1}" ]; then
  	export BASE_URL="http://localhost/citemplate_bb"
fi

# Directory where GVV has been fetched
if [ ! -n "${PROJECT_DIR+1}" ]; then
	export PROJECT_DIR="/var/www/html/citemplate_bb"  
fi

echo "CITEMPLATE installation"
echo "\$BASE_URL = $BASE_URL"
echo "\$PROJECT_DIR = $PROJECT_DIR"

export BASE_URL_PATTERN='http://localhost/citemplate/'

# User ID of the WEB server
export WEB_SERVER_ID=""


# Not changes required below this line
# ===================================================================
# Configure BASE_URL

export CONFIG_FILE="$PROJECT_DIR/application/config/config.php"
echo "Configuration"
echo "    \$BASE_URL=$BASE_URL"
echo "    \$CONFIG_FILE=$CONFIG_FILE"
echo "    \$BASE_URL_PATTERN=$BASE_URL_PATTERN"

# temporairement faire une copy
mv -f $CONFIG_FILE "$CONFIG_FILE.svg"
cp /opt/citemplate/config.php $CONFIG_FILE


# Vérifie les droits d'écriture
#sed s|$BASE_URL_PATTERN|$BASE_URL| $CONFIG_FILE > $CONFIG_FILE
# sed -i s#http://localhost/citemplate#http://localhost/citemplate_bb# $CONFIG_FILE 

# Nettoyage des répertoires

# Vérification des droits
chmod -f a+w $PROJECT_DIR/application/config/program.php

chmod -f 777 $PROJECT_DIR/application/logs
chmod -f 777 $PROJECT_DIR/uploads
mkdir -p $PROJECT_DIR/uploads/restore
chmod -f 777 $PROJECT_DIR/uploads/restore

find $PROJECT_DIR -type d -exec chmod -f a+wx {} \;
chmod -f -R a+r $PROJECT_DIR

return 0
