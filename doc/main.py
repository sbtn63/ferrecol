from fastapi import FastAPI, Header, Response, status, HTTPException
import httpx

from routers.posts import post
from routers.comments import comment
from routers.auth import auth
from routers.departaments import departament
from routers.municipalities import municipality
from routers.user import profile

app = FastAPI()

app.include_router(auth, prefix='/api', tags=['auth'])
app.include_router(profile, prefix='/api/profile', tags=['profile'])
app.include_router(post, prefix='/api/post', tags=['posts'])
app.include_router(comment, prefix='/api/comment', tags=['comments'])
app.include_router(departament, prefix='/api/departament', tags=['departament'])
app.include_router(municipality, prefix='/api/municipality', tags=['municipality'])

@app.get('/')
def hello():
    return {"message" : "Documentation API FerreCol!!"}

@app.get(
    '/sanctum/csrf-cookie',
    tags=["CSRF"]
)
async def csrf_cookie():
    """
    La cookie CSRF es una medida de seguridad que protege contra ataques de falsificación de solicitudes entre sitios (CSRF). Ayuda a asegurar que las solicitudes provienen del usuario autenticado y no de un sitio malicioso que intenta realizar acciones en nombre del usuario retorna un 204 no content pero 
    establece las cabecras necesarias para dar seguridad
    """
    url = 'https://ferrecol.onrender.com/sanctum/csrf-cookie'
    
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(url)
            response.raise_for_status() 
            raise HTTPException(
                status_code=status.HTTP_204_NO_CONTENT,
                detail="No Content",
                headers=response.headers
            )

    except httpx.HTTPStatusError as e:
        raise HTTPException(status_code=e.response.status_code, detail=f"Error HTTP: {e.response.text}")

    except httpx.RequestError as e:
        raise HTTPException(status_code=status.HTTP_500_INTERNAL_SERVER_ERROR, detail=f"Error de solicitud HTTP: {str(e)}")