
# Dependencies

On debian jessie

    apt-get install php5-sqlite
    apt-get install sqlite3

# Create tables

    php bin/CreateTables.php

# Fetch sensordata from TTN

    php bin/FetchNodeData.php

# Spin up app

    php -S localhost:8080  -t web web/index.php

# Cronjob

    */5 * * * * php /home/d/repos/lora-weather/bin/FetchNodeData.php

# API

`/api/all` returns all sensordata.
