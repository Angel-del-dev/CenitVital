export const fillStart = (value: string, fill: string, length: number) => 
    `${value}`.padStart(length, fill);

export const fillDurations = (selected: number = 0) => {
    const durations = [];
    ['', '30min', '1h', '1h 30min', '2h', '2h 30min', '3h', '3h 30min', '4h'].forEach((caption, i) => {
        const duration = {
            caption,
            value: 30*i, // Always working with half hours
        }
        duration.selected = duration.value === selected;
        durations.push(duration);
    })

    return durations;
};

export const isEmpty = (value: string|undefined) => value === undefined || value?.trim() === ''; 