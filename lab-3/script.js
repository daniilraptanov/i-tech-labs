const INDEX_OF_DATE = 2;
const INDEX_OF_TMP_MAX = 3;
const DEFAULT_MIN_OF_TMP = Number.NEGATIVE_INFINITY;

/**
 * 
 * @returns HTMLTableElement | null
 */
function getTable () {
    return document.getElementsByTagName("table")[0];
}


/**
 * 
 * @param {HTMLTableElement} table 
 * @returns HTMLTableRowElement[]
 */
function getRows (table) {
    return Array.from(table.getElementsByTagName("tr"));
}


/**
 * 
 * @param {HTMLTableRowElement} row 
 * @returns HTMLTableCellElement[]
 */
function getCells (row) {
    return Array.from(row.getElementsByTagName("td"));
}


/**
 * 
 * @returns HTMLTableCellElement[][]
 */
function getParsedRowsCells () {
    return getRows(getTable()).map(row => getCells(row));
}


/**
 * 
 * @param {HTMLTableCellElement[][]} rowsCells 
 * @returns { {date: string, tmp: number} }
 */
function calculateHottestDay (rowsCells) {
    const dayObj = {
        date: null,
        tmp: DEFAULT_MIN_OF_TMP,
    };
    rowsCells.forEach((cells) => {
        if (!cells.length) {
            return new Error("CellElements is empty! (because it is table header)");
        }

        const tmp = parseFloat(cells[INDEX_OF_TMP_MAX].textContent);
        const date = cells[INDEX_OF_DATE].textContent;

        if (tmp > dayObj.tmp) {
            dayObj.tmp = tmp;
            dayObj.date = date;
        }
    });

    return dayObj;
}


/**
 * 
 * @returns { {date: string, tmp: number} }
 */
function getHottestDay () {
    return calculateHottestDay(getParsedRowsCells());
}


/**
 * This function is entry point to hottest-day calculating.
 * This function render information modal window about hottest day.
 */
function renderHottestDay () {
    try {
        const hottestDayModal = document.getElementById("hottestDayModal");
        const hottestDayButton = document.getElementById("hottestDayButton");
        const modalCloseButton = document.getElementById("modalCloseButton");

        const hottestDateInfo = document.getElementById("hottestDate");
        const hottestTmpInfo = document.getElementById("hottestTmp");

        hottestDayButton.onclick = function() {
            const dayObj = getHottestDay();

            hottestDayModal.style.display = "block";
            hottestDateInfo.textContent = dayObj.date;
            hottestTmpInfo.textContent = dayObj.tmp;
        }

        modalCloseButton.onclick = function() {
            hottestDayModal.style.display = "none";
        }
    } catch (err) {
        console.log("renderHottestDay: ", err);
    }
}
