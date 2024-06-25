import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  apiUrl: string = 'https://ferrecol.onrender.com/api';

  constructor(private http: HttpClient) { }

  login(email: string, password: string): Observable<any> {
    const loginUrl = `${this.apiUrl}/login`;
    const csrfCookieUrl = 'https://ferrecol.onrender.com/sanctum/csrf-cookie';

    return this.http.get(csrfCookieUrl, { withCredentials: true }).pipe(
      switchMap(() => {
        return this.http.post(loginUrl, { email, password }, { withCredentials: true });
      }),
      catchError(error => {
        console.error('Error al obtener la cookie CSRF:', error);
        return throwError(error);
      })
    );
  }
}
