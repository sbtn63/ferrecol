import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrl: './register.component.scss'
})
export class RegisterComponent implements OnInit {
  loginForm: FormGroup;

  constructor(private formBuilder: FormBuilder, private authService: AuthService) {
    this.loginForm = this.formBuilder.group({
      username: ['', Validators.required],
      email: ['', Validators.required],
      password: ['', Validators.required],
      password_confirmation: ['', Validators.required],
    });
  }

  ngOnInit() {
    
  }

  onSubmit() {
    if (this.loginForm.valid) {
      const { username, email, password, password_confirmation } = this.loginForm.value;
      this.authService.auth(email, password, username, password_confirmation).subscribe(
        response => {
          console.log('Respuesta de autenticación:', response);
          alert('¡Registrado exitosamente!');
          
        },
        error => {
          console.error('Error en el registro:', error);
          alert('Error al registrarse. Por favor, verifica tus credenciales.');
          
        }
      );
    } else {
      alert('Por favor, completa el formulario correctamente.');
    }
  }
}
