export const status = (status) => ({
    pending: 'لم يقرر بعد',
    accepted: 'موافق',
    rejected: 'مرفوض',
}[status] ?? (status ? 'موافق' : 'لم يقرر بعد'));

export const statusClass = (status) => ({
    pending: 'bg-yellow-200',
    accepted: 'bg-green-200',
    rejected: 'bg-red-200',
}[status] ?? (status ? 'bg-green-200' : 'bg-yellow-200'));

