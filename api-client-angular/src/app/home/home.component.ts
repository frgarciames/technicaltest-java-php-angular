import { Router } from '@angular/router';
import { MatDialog } from '@angular/material';
import { Employee } from './../models/employee';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { EmployeeService } from '../services/employee.service';
import { Subscription } from 'rxjs';
import { CreateDialogComponent } from './create-dialog/create-dialog.component';
import { EditDialogComponent } from './edit-dialog/edit-dialog.component';
import { getCookie, deleteCookie } from 'src/helpers/cookie';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit, OnDestroy {

  isActiveSelect: {} = ['Active', 'No active', 'All'];
  displayedColumns: string[] = ['id', 'name', 'clockIn', 'clockOut', 'active', 'actions'];
  selectedIsActive = 'All';
  employees: Employee[];
  subscription: Subscription;
  search: Employee = {
    id: null,
    name: null,
    active: null
  };
  timeout: any;

  constructor(
    public service: EmployeeService,
    private createDialog: MatDialog,
    private editDialog: MatDialog,
    private deleteDialog: MatDialog,
    private router: Router
  ) { }

  ngOnInit() {
    if (!getCookie('logged')) {
      this.router.navigate(['/login']);
    } else {
      this.subscription = this.service.getClients().subscribe(data => {
        this.employees = data;
      });
    }
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }

  handleOnChange() {
    if (this.timeout) {
      clearTimeout(this.timeout);
    }
    this.timeout = setTimeout(() => {
      this.service.searchClients(this.search).subscribe(data => {
        this.employees = data;
      });

    }, 700);
  }

  handleOnChangeSelect() {
    const selected = this.selectedIsActive;
    this.search.active = selected === 'Active' ? true : this.selectedIsActive === 'No active' ? false : null;
    if (this.timeout) {
      clearTimeout(this.timeout);
    }
    this.timeout = setTimeout(() => {
      this.service.searchClients(this.search).subscribe(data => {
        this.employees = data;
      });

    }, 700);
  }

  openCreateDialog() {
    const dialogRef = this.createDialog.open(CreateDialogComponent, {
      width: '500px',
      data: {
        refreshData: () => this.ngOnInit()
      }
    });
  }

  openEditDialog(employee: Employee) {
    const dialogRef = this.editDialog.open(EditDialogComponent, {
      width: '500px',
      data: {
        refreshData: () => this.ngOnInit(),
        employee
      }
    });
  }

  async deleteEmployee(employee: Employee) {
    if (confirm(`Are you sure do you want to remove employee: ${employee.name} ?`)) {
      await this.service.deleteEmployee(employee).toPromise();
      this.ngOnInit();
    }
  }

  logout() {
    deleteCookie('api');
    deleteCookie('logged');
    this.ngOnInit();
  }
}
