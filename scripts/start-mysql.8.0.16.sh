
#!/usr/bin/env bash
set -e

CONTAINER="mysql_8.0.16"
VOLUME="mysql_8.0.16"
NETWORK="shared-network"
IMAGE="mysql:8.0.16"

# Create the volume if it doesn't exist
docker volume inspect "$VOLUME" >/dev/null 2>&1 ||
    docker volume create "$VOLUME" >/dev/null

# Start MySQL if the container already exists
if docker container inspect "$CONTAINER" >/dev/null 2>&1; then
    docker start "$CONTAINER"
else
    read -rsp "Enter MySQL root password: " MYSQL_ROOT_PASSWORD
    echo

    docker run -d \
        --name "$CONTAINER" \
        --platform linux/x86_64 \
        --restart unless-stopped \
        -e MYSQL_ROOT_PASSWORD="$MYSQL_ROOT_PASSWORD" \
        -p 3307:3306 \
        --mount "type=volume,source=$VOLUME,target=/var/lib/mysql" \
        --network "$NETWORK" \
        "$IMAGE" \
        --sql_mode=STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION
fi

echo "MySQL container is running."
echo "Container: $CONTAINER"
echo "Host connection: 127.0.0.1:3307"
echo "Docker network hostname: $CONTAINER"
