from fastapi import APIRouter, HTTPException, status, Header
from pydantic import BaseModel
from typing import Optional

import httpx
from settings import BASE_URL

comment = APIRouter()
url = BASE_URL+'comment'

class ComentData(BaseModel):
    content : str
    post_id : int

class CommentUpdateData(BaseModel):
    content: Optional[str] = None

@comment.post('/')
async def create_comment(comment_data: ComentData, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.post(url, headers=headers, json=comment_data.dict())
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@comment.put('/{id}')
async def update_comment(id : int, comment_data : CommentUpdateData, autorization = Header(...)):
    headers = {
        "Content-Type": "application/json",
        "Authorization" : f"Bearer {autorization}"
    }
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.put(url+f'/{id}', headers=headers, json=comment_data.dict())
        return response.json()

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")

@comment.delete('/{id}')
async def delete_commet(id : int, autorization = Header(...)):
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