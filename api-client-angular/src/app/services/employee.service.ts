import { Employee } from './../models/employee';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { getCookie } from 'src/helpers/cookie';
import { Observable } from 'rxjs';
import { map, tap, catchError } from 'rxjs/operators';

const URL = `http://localhost`;

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {

  constructor(private http: HttpClient) { }

  checkApi() {
    return this.http.get(`${this.getUrl()}/test`, { responseType: 'text' })
      .pipe(
        tap(
          data => data,
          error => error
        )
      );
  }

  getClients(): Observable<Employee[]> {
    return this.http.get(`${this.getUrl()}/employee`)
      .pipe(map((res: any) => res));
  }

  searchClients(attsAndValues: {}): Observable<Employee[]> {
    return this.http.get(
      `${this.getUrl()}/employee?${Object.keys(attsAndValues)
        .map(key => (attsAndValues[key] !== null && attsAndValues[key] !== '') ? `${key}=${attsAndValues[key]}&` : '')
        .join('')
      }`
    )
      .pipe(map((res: any) => res));
  }

  createEmployee(employee: Employee) {
    return this.http.post(`${this.getUrl()}/employee`, employee)
      .pipe(map((res: any) => res));
  }

  updateEmployee(employee: Employee) {
    return this.http.put(`${this.getUrl()}/employee/${employee.id}`, employee)
      .pipe(map((res: any) => res));
  }

  deleteEmployee(employee: Employee) {
    return this.http.delete(`${this.getUrl()}/employee/${employee.id}`)
      .pipe(map((res: any) => res));
  }

  getUrl() {
    return `${URL}:${getCookie('api') === 'Java' ? '8080' : '80'}/api`;
  }
}
