#!/usr/bin/env bash
sh /scripts/sonar-scanner/bin/sonar-scanner   \
-Dsonar.projectKey=PhpKonf   \
-Dsonar.organization=mustafaileri-github   \
-Dsonar.sources=.   \
-Dsonar.host.url=https://sonarcloud.io   \
-Dsonar.login=06ed30b759b07b1bf648a9da2bca486fdfe0c87c