import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ApiDialogComponent } from './api-dialog.component';

describe('ApiDialogComponent', () => {
  let component: ApiDialogComponent;
  let fixture: ComponentFixture<ApiDialogComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ApiDialogComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ApiDialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
