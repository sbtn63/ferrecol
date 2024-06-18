from fastapi import APIRouter, HTTPException, status
import httpx

from settings import BASE_URL

departament = APIRouter()

url = BASE_URL+'departament'

@departament.get('/')
async def read_departaments():
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