import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  url: string = 'https://ferrecol-1.onrender.com/api/login';
  constructor(private http: HttpClient) { }

  auth(): Observable<any> {
    /*return this.http.post(this.url, {
      "email": "mariana@test.com",
      "password": "12345678"
    });

     */
    return this.http.get('https://ferrecol-1.onrender.com/sanctum/csrf-cookie')
  }

  authentication(): Observable<any> {
    return this.http.post(this.url, {
      "email": "mariana@test.com",
      "password": "12345678"
    });
  }
}
