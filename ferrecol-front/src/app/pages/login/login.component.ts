import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})

export class LoginComponent implements OnInit {
  loginForm: FormGroup;

  constructor(private formBuilder: FormBuilder, private authService: AuthService) {
    this.loginForm = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  ngOnInit() {
    
  }

  onSubmit() {
    if (this.loginForm.valid) {
      const { username, password } = this.loginForm.value;
      this.authService.login(username, password).subscribe(
        response => {
          console.log('Respuesta de autenticación:', response);
          alert('¡Inicio de sesión exitoso!');
          
        },
        error => {
          console.error('Error en la autenticación:', error);
          alert('Error al iniciar sesión. Por favor, verifica tus credenciales.');
          
        }
      );
    } else {
      alert('Por favor, completa el formulario correctamente.');
    }
  }
}