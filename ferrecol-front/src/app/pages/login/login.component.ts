import { Component } from '@angular/core';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styles: []
})
export class LoginComponent {
  email: string = '';
  password: string = '';

  constructor(private authService: AuthService) { }

  async authUser(event: Event) {
    event.preventDefault();
    const success = await this.authService.login(this.email, this.password);
    if (success) {
      alert('Logeado');
    } else {
      alert('Error');
    }
  }
}