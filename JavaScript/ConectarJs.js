/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


// Lista de todos los países (16 en total)
            let allCountries = [];
            gameData.forEach(group => {
                group.countries.forEach(country => {
                    allCountries.push({
                        name: country.name,
                        image: country.image,
                        group: group.reason
                    });
                });
            });

            // Variables del juego
            let selectedCountries = [];
            let foundGroups = [];
            let gameCountries = []; // Los países en el juego actual

            // Elementos DOM
            const grid = document.getElementById('countriesGrid');
            const checkButton = document.getElementById('checkButton');
            const scoreElement = document.getElementById('score');
            const solvedGroupsElement = document.getElementById('solvedGroups');

            // Iniciar el juego
            document.addEventListener('DOMContentLoaded', function() {
                // Mostrar el modal de instrucciones
                const instructionModal = new bootstrap.Modal(document.getElementById('instructionModal'));
                instructionModal.show();
                
                // Iniciar el juego
                initGame();
            });

            // Función para iniciar/reiniciar el juego
            function initGame() {
                // Mezclar todos los países
                gameCountries = [...allCountries];
                shuffleArray(gameCountries);

                // Reiniciar variables
                selectedCountries = [];
                foundGroups = [];
                updateScore();
                solvedGroupsElement.innerHTML = '';

                // Crear la cuadrícula
                renderGrid();

                // Configurar botones
                checkButton.disabled = true;
                checkButton.addEventListener('click', checkSelection);
            }

            // Función para recargar la página y obtener nuevas agrupaciones
            function reloadGame() {
                window.location.reload();
            }

            // Función para renderizar la cuadrícula
            function renderGrid() {
                grid.innerHTML = '';
                gameCountries.forEach((country, index) => {
                    if (!foundGroups.some(group => group.includes(country.name))) {
                        const button = document.createElement('button');
                        button.className = 'country-button';
                        button.dataset.index = index;

                        // Crear y añadir la imagen
                        const img = document.createElement('img');
                        img.src = country.image;
                        img.alt = country.name;
                        img.className = 'country-image';

                        // Crear el texto del país
                        const text = document.createElement('div');
                        text.textContent = country.name;

                        button.appendChild(img);
                        button.appendChild(text);

                        button.addEventListener('click', () => {
                            toggleCountrySelection(index, button);
                        });

                        grid.appendChild(button);
                    } else {
                        // Si el país ya está en un grupo encontrado, crear un espacio vacío
                        const emptySpace = document.createElement('div');
                        grid.appendChild(emptySpace);
                    }
                });
            }

            // Función para seleccionar/deseleccionar un país
            function toggleCountrySelection(index, button) {
                const countryIndex = selectedCountries.findIndex(c => c === index);

                if (countryIndex === -1) {
                    // Si no está seleccionado y hay menos de 4 seleccionados
                    if (selectedCountries.length < 4) {
                        selectedCountries.push(index);
                        button.classList.add('selected');
                    }
                } else {
                    // Si ya está seleccionado, quitarlo
                    selectedCountries.splice(countryIndex, 1);
                    button.classList.remove('selected');
                }

                // Actualizar estado del botón de comprobar
                checkButton.disabled = selectedCountries.length !== 4;
            }

            // Función para comprobar la selección
            function checkSelection() {
                if (selectedCountries.length !== 4)
                    return;

                const selectedCountryObjects = selectedCountries.map(index => gameCountries[index]);
                const selectedCountryNames = selectedCountryObjects.map(country => country.name);

                // Verificar si estos países pertenecen al mismo grupo
                let isCorrect = false;
                let groupReason = "";

                for (const group of gameData) {
                    const groupCountryNames = group.countries.map(c => c.name);
                    // Verificar si todos los países seleccionados están en este grupo
                    if (selectedCountryNames.every(country => groupCountryNames.includes(country)) &&
                            selectedCountryNames.length === groupCountryNames.length) {
                        isCorrect = true;
                        groupReason = group.reason;
                        break;
                    }
                }

                if (isCorrect) {
                    // ¡Correcto!
                    foundGroups.push(selectedCountryNames);
                    displayFoundGroup(selectedCountryObjects, groupReason);
                    updateScore();

                    // Quitar los países encontrados de la cuadrícula
                    selectedCountries = [];
                    renderGrid();
                    checkButton.disabled = true;

                    // Verificar si se han encontrado todos los grupos
                    if (foundGroups.length === gameData.length) {
                        window.location.href = "Juego3.php";

                    }
                } else {
                    // Incorrecto - animación de error
                    grid.classList.add('shake');
                    setTimeout(() => {
                        grid.classList.remove('shake');
                    }, 500);

                    // Deseleccionar todos los países
                    document.querySelectorAll('.country-button.selected').forEach(button => {
                        button.classList.remove('selected');
                    });
                    selectedCountries = [];
                    checkButton.disabled = true;
                }
            }

            // Función para mostrar un grupo encontrado
            function displayFoundGroup(countries, reason) {
                const groupElement = document.createElement('div');
                groupElement.className = 'group';

                const countriesElement = document.createElement('div');
                countriesElement.className = 'group-countries';

                // Añadir cada país con su bandera
                countries.forEach(country => {
                    const countrySpan = document.createElement('span');

                    const flagImg = document.createElement('img');
                    flagImg.src = country.image;
                    flagImg.alt = country.name;
                    flagImg.className = 'country-flag';

                    countrySpan.appendChild(flagImg);
                    countrySpan.appendChild(document.createTextNode(country.name));

                    countriesElement.appendChild(countrySpan);
                });

                const reasonElement = document.createElement('div');
                reasonElement.className = 'group-reason';
                reasonElement.textContent = `Razón: ${reason}`;

                groupElement.appendChild(countriesElement);
                groupElement.appendChild(reasonElement);
                solvedGroupsElement.appendChild(groupElement);
            }

            // Función para actualizar la puntuación
            function updateScore() {
                scoreElement.textContent = `${foundGroups.length}/${gameData.length}`;
            }

            // Función para mezclar un array
            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }