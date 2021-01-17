document.addEventListener('DOMContentLoaded',() => {
    const modal = M.Modal.init(document.getElementById('modalUsuario'));
    document.addEventListener('click', (e) => {
       if(e.target.classList.contains('mostrar')){
           mostrarUsuario(e.target.id.replace('mostrar-',''));
       }
       if(e.target.classList.contains('eliminar')){
           eliminarUsuario(e.target.id.replace('eliminar-',''));
       }
        if(e.target.classList.contains('mostrarV')){
            mostrarVehiculo(e.target.id.replace('mostrarV-',''));
        }
    });

    function mostrarUsuario(id){
        fetch(`/users/${id}`)
            .then(res => res.json())
            .then(res => {
                console.log(res);
                const modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                  <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <div class="row valign-wrapper">
                        <div class="col s2">
                          <img src='http://127.0.0.1:8000/storage/${res.profilePick}'class="circle responsive-img"> <!-- notice the "circle" class -->
                        </div>
                        <div class="col s10">
                            <h5>Datos generales</h5>
                            <div class="row">
                                <div class="col s12">
                                    <p>Nombre: <span>${res.name} ${res.surnames}</span></p>
                                    <p>Estado civil: <span>${res.civilStatus == null ? '- - -' : res.civilStatus}</span></p>
                                    <p>Teléfono: <span>${res.phoneNumber == null ? '- - -' : res.phoneNumber}</span></p>
                                    <p>Escolaridad: <span>${res.scholarship == null ? '- - -' : res.scholarship}</span></p>
                                    <p>Curp: <span>${res.curp}</span></p>
                                    <p>RFC: <span>${res.rfc}</span></p>
                                    <p>Dirección: <span>${res.adrres == null ? '- - -' : res.adrres}</span> Colonia: <span>${res.street == null ? '- - -' : res.street}</span></p>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                `;
                modal.open();
            })
    }

    function mostrarVehiculo(id){
        fetch(`/vehicles/${id}`)
            .then(res => res.json())
            .then(res => {
                console.log(res);
                const modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                  <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <div class="row valign-wrapper">
                        <div class="col s2">
                          <img src='http://127.0.0.1:8000/storage/${res.image}'class="responsive-img">
                        </div>
                        <div class="col s10">
                            <h5>Datos generales</h5>
                            <div class="row">
                                <div class="col s12">
                                    <p>Propietario: <span>${res.titular}</span></p>
                                    <p>Matrícula: <span>${res.label}</span></p>
                                    <p>Modelo: <span>${res.model}</span></p>
                                    <p>Cabina: <span>${res.cabina == null ? '- - -' : res.cabina}</span> Color: <span>${res.color == null ? '- - -' : res.color}</span></p>
                                    <p>Fecha: <span>${res.date == null ? '- - -' : res.date}</span> Motor: <span>${res.engine == null ? '- - -' : res.engine}</span></p>
                                    <p>Llantas: <span>${res.llantas == null ? '- - -' : res.lantas}</span> Propulsión: <span>${res.propulsion == null ? '- - -' : res.propulsion}</span></p>
                                    <p>Tipo: <span>${res.type == null ? '- - -' : res.type}</span></p>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                `;
                modal.open();
            })
    }

    function eliminarUsuario(id){
        fetch(`/users/${id}`,{
            method: 'POST'
        })
            .then(res => res.json())
            .then(res => {
                console.log(res);
            })
    }
});
