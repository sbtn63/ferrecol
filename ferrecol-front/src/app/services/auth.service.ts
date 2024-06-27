import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  url: string = 'https://ferrecol.onrender.com';

  constructor(private http: HttpClient) { }

  auth(email : string, password : string,  username : string = '', password_confirmation : string = '') : Observable<any>{
    return this.http.get(`${this.url}/sanctum/csrf-cookie`, { withCredentials: true }).pipe(
      switchMap(() => {
        if (username == '' || password_confirmation == ''){
          return this.http.post(`${this.url}/api/login`, { email, password }, { withCredentials: true });
        } else {
          return this.http.post(`${this.url}/api/register`, {username, email, password, password_confirmation }, { withCredentials: true });
        }
      }),
      catchError(error => {
        console.error('Error al obtener la cookie CSRF:', error);
        return throwError(error);
      })
    );
  }

  /* login(email: string, password: string): Observable<any> {
    const loginUrl = `${this.url}/api/login`;

    return this.http.get(`${this.url}/sanctum/csrf-cookie`, { withCredentials: true }).pipe(
      switchMap(() => {
        return this.http.post(loginUrl, { email, password }, { withCredentials: true });
      }),
      catchError(error => {
        console.error('Error al obtener la cookie CSRF:', error);
        return throwError(error);
      })
    );
  }

  register(username : string, email: string, password: string, password_confirmation : string): Observable<any> {
    const registerUrl = `${this.url}/api/register`;

    return this.http.get(`${this.url}/sanctum/csrf-cookie`, { withCredentials: true }).pipe(
      switchMap(() => {
        return this.http.post(registerUrl, {username, email, password, password_confirmation }, { withCredentials: true });
      }),
      catchError(error => {
        console.error('Error al obtener la cookie CSRF:', error);
        return throwError(error);
      })
    ); */
}


