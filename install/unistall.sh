# Annule certaines modification d'installation
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
rm $CONFIG_FILE
mv "$CONFIG_FILE.svg" $CONFIG_FILE


