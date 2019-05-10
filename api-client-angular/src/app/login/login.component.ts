import { getCookie } from 'src/helpers/cookie';
import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material';
import { Router } from '@angular/router';
import { ApiDialogComponent } from '../api-dialog/api-dialog.component';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  isLogged = getCookie('logged');
  name = 'Antonio';

  constructor(private dialog: MatDialog, private router: Router) { }

  ngOnInit() {
    if (this.isLogged) {
      this.router.navigate(['/home']);
    }
  }

  handleOnLogin() {

  }

  openDialogChooseApi() {
    const dialogRef = this.dialog.open(ApiDialogComponent, {
      width: '300px',
      data: {
        name
      }
    });
  }

}
