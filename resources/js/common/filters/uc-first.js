export function ucFirst() {
    return function (string) {
        if (!string) return string;

        return string[0].toUpperCase() + string.slice(1);
    }
}