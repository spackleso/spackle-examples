run:
	flask -e .env -A app:app run

build:
	poetry install
	poetry run pip install --upgrade pip
	poetry run pip install --force-reinstall -U setuptools

default: run