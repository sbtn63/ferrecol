from fastapi import APIRouter, HTTPException, status, Header
from pydantic import BaseModel
from typing import Optional

import httpx
from settings import BASE_URL

post = APIRouter()
url = BASE_URL+'post'

class PostData(BaseModel):
    title : str
    content : str
    file_url : str = None
    train_station_id : int

class PostUpdateData(BaseModel):
    title: Optional[str] = None
    content: Optional[str] = None
    file_url: Optional[str] = None
    train_station_id : Optional[int] = None

@post.get('/')
async def read_posts():
    headers = {
        "Content-Type": "application/json",
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(url, headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=500, detail=f"Error de solicitud HTTP: {str(e)}")

@post.get('/full')
async def read_full_posts():
    headers = {
        "Content-Type": "application/json",
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f'{url}/full', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=500, detail=f"Error de solicitud HTTP: {str(e)}")
    
@post.get('/{id}')
async def get_post(id : int):
    headers = {
        "Content-Type": "application/json"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(url+f'/{id}', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@post.get('/full/{id}')
async def get_full_post(id : int):
    headers = {
        "Content-Type": "application/json"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f'{url}/full/{id}', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@post.get('/{id}/comments')
async def get_commets_post(id : int, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f'{url}/{id}/comments', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@post.post('/')
async def create_post(post_data: PostData, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.post(url, headers=headers, json=post_data.dict())
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@post.put('/{id}')
async def update_post(id : int, post_data : PostUpdateData, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            post_data = post_data.dict(exclude_unset=True)
            response = await client.put(url+f'/{id}', headers=headers, json=post_data)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@post.delete('/{id}')
async def delete_post(id : int, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.delete(url+f'/{id}', headers=headers)
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")