export function percent() {
    return function (input) {
        if (input && input.toString().indexOf('%') < 0) {
            return (input) + '%';
        }

        return input
    };
}

