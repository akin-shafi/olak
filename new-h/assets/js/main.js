$(document).ready(function () {
  const message = (req, res) => {
    swal(req + "!", res, {
      icon: req,
      timer: 2000,
      buttons: {
        confirm: {
          className: req == "error" ? "btn btn-danger" : "btn btn-success",
        },
      },
    })
    // .then(() => location.reload());
  };

  const deleted = async (url) => {
    swal({
      title: "Are you sure?",
      text: "You won't be able to reverse this!",
      icon: "warning",
      buttons: {
        confirm: {
          text: "Yes, delete it!",
          className: "btn btn-danger",
        },
        cancel: {
          visible: true,
          className: "btn btn-secondary",
        },
      },
    }).then((Delete) => {
      if (Delete) {
        fetch(url)
          .then((res) => res.json())
          .then((data) => {
            swal({
              title: "Deleted!",
              text: data.message,
              icon: "success",
              buttons: {
                confirm: {
                  className: "btn btn-success",
                },
              },
            }).then(() => location.reload());
          });
      } else {
        swal.close();
      }
    });
  };

  const submitForm = async (url, payload) => {
    const formData = new FormData(payload);

    const data = await fetch(url, {
      method: "POST",
      body: formData,
    });

    const res = await data.json();

    if (res.errors) {
      message("error", res.errors);
    }

    if (res.message) {
      message("success", res.message);
    }
  };

  const EMPLOYEE_URL = "../inc/employee/";

  const attendanceForm = document.querySelector("#attendance_form");
  const personalForm = document.getElementById("add_personal_form");
  const employeeCompForm = document.getElementById("add_employee_company_form");
  const bankForm = document.getElementById("add_bank_form");
  const docForm = document.getElementById("add_doc_form");

  personalForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    submitForm(EMPLOYEE_URL, personalForm);
  });

  employeeCompForm.addEventListener("submit", (e) => {
    e.preventDefault();
    submitForm(EMPLOYEE_URL, employeeCompForm);
  });

  bankForm.addEventListener("submit", (e) => {
    e.preventDefault();
    submitForm(EMPLOYEE_URL, bankForm);
  });

  docForm.addEventListener("submit", (e) => {
    e.preventDefault();
    submitForm(EMPLOYEE_URL, docForm);
  });

  attendanceForm.addEventListener("submit", (e) => {
    e.preventDefault();
    submitForm(EMPLOYEE_URL, attendanceForm);
  });

  const SETTING_URL = "../inc/setting/";

  const departmentModal = new bootstrap.Modal(
    document.querySelector("#department_modal")
  );
  const departmentForm = document.querySelector("#add_department_form");
  const departmentTitle = document.querySelector("#department-title");
  const departmentBtn = document.querySelector("#add_department_btn");

  const designateModal = new bootstrap.Modal(
    document.querySelector("#designation_modal")
  );
  const designationForm = document.querySelector("#add_designation_form");
  const designationTitle = document.querySelector("#designation-title");
  const designationBtn = document.querySelector("#add_designation_btn");

  departmentForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    submitForm(SETTING_URL, departmentForm);
  });

  $("#dept-table tbody").on("click", "#edit-dept-btn", async function () {
    let id = this.dataset.id;

    let data = await fetch(SETTING_URL + "?departmentId=" + id);
    let response = await data.json();

    document.getElementById("departmentId").value = id;
    document.getElementById("dept_name").value = response.data.department_name;

    departmentTitle.innerText = "Edit Department";
    departmentBtn.innerText = "Update";

    departmentModal.show();

    departmentBtn.addEventListener("click", async (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, departmentForm);
    });

    $("#department_modal").on("hidden.bs.modal", function () {
      location.reload();
    });
  });

  $(document).on("click", "#delete_dept", function () {
    let delId = this.dataset.id;
    deleted(SETTING_URL + "?departmentId=" + delId + "&deleteDept=1");
  });
  /* ----------------------------- // ? DEPARTMENT END ---------------------------- */

  /* ----------------------------- // ? DESIGNATION START ---------------------------- */

  designationForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    submitForm(SETTING_URL, designationForm);
  });

  $("#des-table tbody").on("click", "#edit_des", async function () {
    let id = this.dataset.id;

    let data = await fetch(SETTING_URL + "?designationId=" + id);
    let response = await data.json();

    document.getElementById("designationId").value = id;
    document.getElementById("des_name").value = response.data.designation_name;
    document.getElementById("dept_id").value = response.data.department_id;

    designationTitle.innerText = "Edit Designation";
    designationBtn.innerText = "Update";

    designateModal.show();

    designationBtn.addEventListener("click", async (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, designationForm);
    });

    $("#designation_modal").on("hidden.bs.modal", function () {
      location.reload();
    });
  });

  $(document).on("click", "#delete_des", function () {
    let delId = this.dataset.id;
    deleted(SETTING_URL + "?designationId=" + delId + "&deleteDes=1");
  });
  /* ----------------------------- // ? DESIGNATION END ---------------------------- */
});
