from fastapi import FastAPI

from routers.posts import post
from routers.comments import comment
from routers.auth import auth
from routers.departaments import departament
from routers.municipalities import municipality
from routers.user import profile

app = FastAPI()

app.include_router(auth, tags=['auth'])
app.include_router(profile, tags=['profile'])
app.include_router(post, prefix='/post', tags=['posts'])
app.include_router(comment, prefix='/comment', tags=['comments'])
app.include_router(departament, prefix='/departament', tags=['departament'])
app.include_router(municipality, prefix='/municipality', tags=['municipality'])

@app.get('/')
def hello():
    return {"message" : "Documentation API FerreCol!!"}