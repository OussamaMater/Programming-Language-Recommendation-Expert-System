FROM python:3.9

WORKDIR /app

COPY expert-system/requirements.txt .

RUN pip install --no-cache-dir --upgrade -r requirements.txt

EXPOSE 5500

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "5500"]