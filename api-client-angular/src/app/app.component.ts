import { Component, OnInit } from '@angular/core';
import { getCookie } from 'src/helpers/cookie';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  isLogged = getCookie('logged');

  constructor(private router: Router) { }

  ngOnInit() {
    if (this.isLogged) {
      this.router.navigate(['/home']);
    } else {
      this.router.navigate(['/login']);
    }
  }
}
