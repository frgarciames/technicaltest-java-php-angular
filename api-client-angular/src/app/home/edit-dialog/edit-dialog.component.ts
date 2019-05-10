import { Component, OnInit, Inject } from '@angular/core';
import { EmployeeService } from 'src/app/services/employee.service';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';
import { CreateDialogComponent } from '../create-dialog/create-dialog.component';
import { Employee } from 'src/app/models/employee';

@Component({
  selector: 'app-edit-dialog',
  templateUrl: './edit-dialog.component.html',
  styleUrls: ['./edit-dialog.component.scss']
})
export class EditDialogComponent implements OnInit {

  employee: Employee;

  constructor(
    private service: EmployeeService,
    private dialogRef: MatDialogRef<CreateDialogComponent>,
    @Inject(MAT_DIALOG_DATA) private data: any
  ) { }

  ngOnInit() {
    this.employee = this.data.employee;
  }

  async handleOnClick() {
    await this.service.updateEmployee(this.employee).toPromise();
    this.dialogRef.close();
    this.data.refreshData();
  }

}
