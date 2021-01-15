document.addEventListener('DOMContentLoaded',() => {
    const modal = M.Modal.init(document.getElementById('modalVehiculo'));
    document.addEventListener('click', (e) => {
        if(e.target.classList.contains('mostrar')){
            mostrarUsuario(e.target.id.replace('mostrar-',''));
        }
        if(e.target.classList.contains('eliminar')){
            eliminarUsuario(e.target.id.replace('eliminar-',''));
        }
    });

    function mostrarUsuario(id){
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
