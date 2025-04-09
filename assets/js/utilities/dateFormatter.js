export const dateFormatter = (d) => {
    const date = new Date(d)
    return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    })
}