import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private token: string;

  constructor() {
    this.token = '';
  }

  getToken(): string {
    return this.token;
  }

  async login(email: string, password: string): Promise<boolean> {
    try {
      const url = 'https://ferrecol.onrender.com/api/login';

      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          email: email,
          password: password
        })
      });

      const response = await res.json();
      if (response.error) {
        console.log(response.message);
        return false;
      }

      this.token = response.data.token;
      console.log(this.token)
      return true;

    } catch (error) {
      console.log(error);
      return false;
    }
  }
}