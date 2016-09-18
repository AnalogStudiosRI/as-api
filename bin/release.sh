#!/usr/bin/env bash

scp -i $PEM_FILE -o StrictHostKeyChecking=no ./build/* ubuntu@52.91.27.217:/home/ubuntu