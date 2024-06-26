from fastapi import APIRouter, HTTPException, status, Header
from pydantic import BaseModel
from typing import Optional

import httpx
from settings import BASE_URL

profile = APIRouter()
url = BASE_URL+'profile'

class UserUpdateData(BaseModel):
    email: Optional[str] = None
    username: Optional[str] = None
    password: str
    new_password : Optional[str] = None



@profile.get('/')
async def get_auth_user(autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    timeout = httpx.Timeout(20.0)
    
    try:
        async with httpx.AsyncClient(timeout=timeout) as client:
            response = await client.get(f'{url}/', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")
    
@profile.get('/{id}')
async def get_user(id : int, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    timeout = httpx.Timeout(20.0)
    
    try:
        async with httpx.AsyncClient(timeout=timeout) as client:
            response = await client.get(f'{url}/{id}', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")
    
@profile.get('/full/{id}')
async def get_user_full(id : int, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    timeout = httpx.Timeout(20.0)
    
    try:
        async with httpx.AsyncClient(timeout=timeout) as client:
            response = await client.get(f'{url}/full/{id}', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@profile.put('/')
async def update_user(user_data : UserUpdateData, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    timeout = httpx.Timeout(20.0)
    
    try:
        async with httpx.AsyncClient(timeout=timeout) as client:
            user = await client.get(url, headers=headers)
            user_data = {name: content for name, content in user_data}
            
            if user.status_code == 200:
                user = user.json()
                for key, value in user['data'].items():
                    if key in user_data and user_data[key] is None:
                        user_data[key] = value

            response = await client.put(url, headers=headers, json=user_data)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")