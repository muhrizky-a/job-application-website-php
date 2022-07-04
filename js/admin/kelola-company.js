const baseUrl = "..";

async function validateCompany(idCompany) {
    // const data = { id: idCompany, validate_company: 1 };
    // const response = await fetch(
    //     `${baseUrl}/controller/company-controller.php?validate_company`, {
    //         method: 'POST', // *GET, POST, PUT, DELETE, etc.
    //         body: JSON.stringify(data) // body data type must match "Content-Type" header
    //     }
    // );
    const response = await fetch(
        `${baseUrl}/controller/company-controller.php?validate_company_id=${idCompany}`
    );
    return response.json();
};

async function doValidateCompany(id) {
    await validateCompany(id)
        .then((data) => {
            alert("Perubahan status perusahaan Berhasil.");
        })
        .catch((err) => {
            alert("Perubahan status perusahaan Gagal.");
        });
    await doShowPendingCompany();
}

async function deleteCompany(idCompany) {
    const response = await fetch(
        `${baseUrl}/controller/company-controller.php?delete_id=${idCompany}`
    );
    return response.json();
};

async function doDeleteCompany(id) {
    await deleteCompany(id)
        .then((data) => {
            alert("Company Berhasil Dihapus.");
        })
        .catch((err) => {
            alert("Company Gagal Dihapus.");
        });
    await doShowPendingCompany();
}

async function showPendingCompany() {
    const response = await fetch(
        `${baseUrl}/controller/company-controller.php?show_pending_companies`
    );
    return response.json();
};


function doShowPendingCompany() {
    const pendingCompanyDiv = document.querySelector(".pending-companies");
    showPendingCompany()
        .then((data) => {
            pendingCompanyDiv.innerHTML = `
                <h2>Pending Companies</h2>
                <br>
            `;
            if (data.length == 0) {
                pendingCompanyDiv.innerHTML += "<p>Daftar Perusahaan Kosong.</p>"
                pendingCompanyDiv.className += " empty";
            } else {
                data.forEach(row => {
                    pendingCompanyDiv.innerHTML += `
                    <div class="card">
                        <div class="card-info company-image-wrapper">
                            <img class="company-pic" src="../assets/images/company-profile/${row['image']}" alt="Company Logo">
                        </div>
                        <div class="card-info card-detail">
                            <h3>${row['nama']}</h3>
                            <p>${row['alamat']}</p>
                        </div>
                        <div class="card-info action">
                            <a class="valid-btn" title="Validasi" onclick="doValidateCompany(${row['id']})"><i class="fa fa-check" aria-hidden="true"></i></a>
                            <a class="delete-btn" onclick="confirmDelete(${row['id']})" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    `;
                });
            }
        })
        .catch((err) => {
            alert(`Load Data Gagal.`);
        });
}

function confirmDelete(id) {
    const konfirmasi = confirm("Apakah anda yakin ingin menghapus company ini?");
    if (konfirmasi) {
        doDeleteCompany(id);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    doShowPendingCompany();
});