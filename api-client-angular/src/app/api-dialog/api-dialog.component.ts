import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';
import { EmployeeService } from './../services/employee.service';
import { Component, OnInit, Inject } from '@angular/core';
import { Router } from '@angular/router';
import { deleteCookie } from 'src/helpers/cookie';

@Component({
  selector: 'app-api-dialog',
  templateUrl: './api-dialog.component.html',
  styleUrls: ['./api-dialog.component.scss']
})
export class ApiDialogComponent implements OnInit {
  apiServerOptions: string[] = ['PHP', 'Java'];
  selected = 'Java';
  apiError = false;
  loading = false;
  constructor(
    private router: Router,
    private employeeService: EmployeeService,
    private dialogRef: MatDialogRef<ApiDialogComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any
  ) { }

  ngOnInit() { }

  async setApiServer() {
    this.loading = true;
    document.cookie = `api=${this.selected}`;
    try {
      await this.employeeService.checkApi().toPromise();
      document.cookie = `logged=${true}`;
      this.dialogRef.close();
      this.loading = false;
      this.apiError = false;
      this.router.navigate(['/home']);
    } catch (error) {
      this.loading = false;
      this.apiError = true;
      deleteCookie('api');
    }
    // this.router.navigate(['/home']);
  }

}
