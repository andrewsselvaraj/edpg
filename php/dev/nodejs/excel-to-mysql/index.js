const ExcelJS = require('exceljs');
const fs = require('fs');
const path = require('path');

async function excelToSQLFile(excelFilePath, sqlFilePath, tableName) {
  const workbook = new ExcelJS.stream.xlsx.WorkbookReader();
  const stream = fs.createReadStream(excelFilePath);
  const options = {
    worksheets: 'emit',
    sharedStrings: 'cache',
    hyperlinks: 'cache',
    styles: 'cache',
    entries: 'emit'
  };

  workbook.read(stream, options);

  let headers = [];
  let sqlStatements = [];

  workbook.on('worksheet', worksheet => {
    worksheet.on('row', row => {
      if (row.number === 1) {
        // Extract column names from the first row
        headers = row.values.slice(1); // slice(1) to remove the first empty element
      } else {
        // Prepare an SQL statement for each row
        const rowData = row.values.slice(1);
        const values = rowData.map(value => 
          typeof value === 'string' ? `'${value.replace(/'/g, "''")}'` : value
        );
        sqlStatements.push(`INSERT INTO ${tableName} (${headers.join(', ')}) VALUES (${values.join(', ')});`);
      }
    });

    worksheet.on('end', () => {
      // Write SQL statements to a file when worksheet reading is done
      fs.writeFileSync(sqlFilePath, sqlStatements.join('\n'));
    });
  });

  workbook.on('end', () => {
    console.log(`SQL file created at ${sqlFilePath}`);
  });
}

// Example usage
const excelFilePath = './excelfile.xlsx';
const sqlFilePath = path.join(__dirname, 'output.sql'); // Change as needed
const tableName = 'sample';

excelToSQLFile(excelFilePath, sqlFilePath, tableName);
