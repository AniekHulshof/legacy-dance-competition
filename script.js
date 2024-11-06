document.addEventListener("DOMContentLoaded", function () {
    const addCoachButton = document.getElementById('addCoach');
    const deleteCoachButton = document.getElementById('deleteCoach');
    const coachesList = document.querySelector('.coachesList');
    let coachCounter = 1;

    addCoachButton.addEventListener("click", function () {
        const coachHTML = `
        <div class="mb-3" id="coach${coachCounter}">
            <div class="field is-grouped">
                <div class="control is-expanded">
                    <label class="label" for="naam${coachCounter}">Naam</label>
                    <input class="input" type="text" name="naam${coachCounter}" id="naam${coachCounter}">
                </div>
                <div class="control is-expanded">
                    <label class="label" for="telefoon${coachCounter}">Telefoonnummer</label>
                    <input class="input" type="tel" name="telefoon${coachCounter}" id="telefoon${coachCounter}">
                </div>
            </div>
            <div class="field">
                <div class="control is-expanded">
                    <label class="label" for="email${coachCounter}">Email</label>
                    <input class="input" type="email" name="email${coachCounter}" id="email${coachCounter}" autocomplete="email">
                </div>
            </div>
        </div>`

        coachesList.insertAdjacentHTML('beforeend', coachHTML);
        coachCounter++;
    });

    deleteCoachButton.addEventListener('click', function () {
        if (coachCounter > 1) {
            coachCounter--;
            const lastCoach = document.getElementById(`coach${coachCounter}`);
            if (lastCoach) {
                lastCoach.remove();
            }
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const addTeamButton = document.getElementById('addTeam');
    const deleteTeamButton = document.getElementById('deleteTeam');
    const teamsList = document.querySelector('.teamsList');
    let teamCounter = 1;

    addTeamButton.addEventListener("click", function () {
        const teamHTML = `
            <div class="mb-3" id="team${teamCounter}">
            <div class="field">
                <div class="control is-expanded">
                    <label class="label" for="teamnaam${teamCounter}">Teamnaam</label>
                    <input class="input" type="text" name="teamnaam${teamCounter}" id="teamnaam${teamCounter}">
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <label class="label" for="categorieTeam${teamCounter}">Categorie</label>
                    <div class="select">
                        <select name="categorieTeam${teamCounter}" id="categorieTeam${teamCounter}">
                            <option disabled selected></option>
                            <option>Recreatie 5 t/m 8 jaar</option>
                            <option>Selectie 5 t/m 8 jaar</option>
                            <option>Recreatie 9 t/m 10 jaar</option>
                            <option>Recreatie 11 t/m 12 jaar</option>
                            <option>Selectie 9 t/m 12 jaar</option>
                            <option>Demo 9 t/m 12 jaar</option>
                            <option>Recreatie 13 t/m 16 jaar</option>
                            <option>Selectie 13 t/m 16 jaar</option>
                            <option>Demo 13 t/m 16 jaar</option>
                            <option>Recreatie 17 jaar en ouder</option>
                            <option>Selectie 17 jaar en ouder</option>
                            <option>Demo 17 jaar en ouder</option>
                            <option>Recreatie 30+</option>
                        </select>
                    </div>
                </div>
                <div class="control is-expanded">
                    <label class="label" for="aantalDansers${teamCounter}">Aantal dansers</label>
                    <input class="input" type="number" name="aantalDansers${teamCounter}" id="aantalDansers${teamCounter}">
                </div>
        </div>`;

        teamsList.insertAdjacentHTML('beforeend', teamHTML);
        teamCounter++;
    });

    deleteTeamButton.addEventListener('click', function () {
        if (teamCounter > 1) {
            teamCounter--;
            const lastTeam = document.getElementById(`team${teamCounter}`);
            if (lastTeam) {
                lastTeam.remove();
            }
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const addDuoButton = document.getElementById('addDuo');
    const deleteDuoButton = document.getElementById('deleteDuo');
    const duosList = document.querySelector('.duosList');
    let duoCounter = 1;

    addDuoButton.addEventListener("click", function () {
        const duoHTML = `
            <div class="mb-3" id="duo${duoCounter}">
                <div class="field is-grouped">
                    <div class="control is-expanded">
                        <label class="label" for="namenDansers${duoCounter}">Namen dansers</label>
                        <input class="input" type="text" name="namenDansers${duoCounter}" id="namenDansers${duoCounter}">
                    </div>
                    <div class="control">
                        <label class="label" for="categorieDuo${duoCounter}">Categorie</label>
                        <div class="select">
                            <select name="categorieDuo${duoCounter}" id="categorieDuo${duoCounter}">
                                <option disabled selected></option>
                                <option>5 t/m 8 jaar</option>
                                <option>9 t/m 10 jaar</option>
                                <option>11 t/m 12 jaar</option>
                                <option>13 t/m 16 jaar</option>
                                <option>17 jaar en ouder</option>
                                <option>30+</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div > `;

        duosList.insertAdjacentHTML('beforeend', duoHTML);
        duoCounter++;
    });

    deleteDuoButton.addEventListener('click', function () {
        if (duoCounter > 1) {
            duoCounter--;
            const lastDuo = document.getElementById(`duo${duoCounter}`);
            if (lastDuo) {
                lastDuo.remove();
            }
        }
    });
});