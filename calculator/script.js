function clearDisplay() {
    document.calc.display.value = '';
}

function deleteLastChar() {
    const display = document.calc.display;
    display.value = display.value.slice(0, -1);
}

function appendCharacter(char) {
    const display = document.calc.display;
    display.value += char;
}

function calculateResult() {
    const display = document.calc.display;
    try {
        display.value = eval(display.value);
    } catch (e) {
        alert('Invalid Expression');
    }
}
