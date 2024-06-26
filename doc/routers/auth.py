from fastapi import APIRouter, HTTPException, status, Depends, Header
from pydantic import BaseModel
from typing import Optional

import httpx
from settings import BASE_URL

auth = APIRouter()
url = BASE_URL

class LoginData(BaseModel):
    email: str
    password: str

class RegisterData(BaseModel):
    username : str
    email: str
    avatar : Optional[str] = None
    password: str
    password_confirmation : str

@auth.post('/login')
async def login(login_data: LoginData):
    url = BASE_URL + 'login'
    headers = {
        "Content-Type": "application/json",
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.post(url, headers=headers, json=login_data.dict())
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@auth.post('/register')
async def register(register_data: RegisterData):
    url = BASE_URL + 'register'
    headers = {
        "Content-Type": "application/json",
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.post(url, headers=headers, json=register_data.dict())
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@auth.post('/logout')
async def logout(autorization = Header(...)):
    url = BASE_URL + 'logout'
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.post(url, headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")