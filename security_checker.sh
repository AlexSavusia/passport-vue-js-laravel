#!/usr/bin/env bash

SCRIPT="local-php-security-checker"
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

if [ -z "${SYSTEM}" ]; then SYSTEM="linux_amd64"; fi

URL=$(
  curl -s https://api.github.com/repos/fabpot/local-php-security-checker/releases/latest \
        | grep -o "https.*local-php-security-checker_.*_${SYSTEM}"
)

# Скачиваем артефакт и изменяем права для его исполнения
curl -L "${URL}" --output "${SCRIPT}" --silent && chmod +x "${SCRIPT}"

# Запускаем проверку на наличие уязвимостей
./"${SCRIPT}" --path="${DIR}"

CHECKER_EXIT_CODE=$?

# Удаляем скаченный файл
rm -f "${SCRIPT}" || true

exit "${CHECKER_EXIT_CODE}"