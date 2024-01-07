package com.exceldisplayjsp;

import org.apache.poi.ss.usermodel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestPart;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;



@Controller
public class FileController {

 @PostMapping("/upload")
 public ModelAndView uploadFile(@RequestPart("file") @RequestParam("file") MultipartFile file) {
     ModelAndView modelAndView = new ModelAndView("display");
     List<List<String>> data = new ArrayList<>();
     List<String> header = new ArrayList<>();
     boolean displayCheckbox = false;

     try (Workbook workbook = WorkbookFactory.create(file.getInputStream())) {
         Sheet sheet = workbook.getSheetAt(0);

        
         Row headerRow = sheet.getRow(0);
         if (headerRow != null) {
             for (Cell cell : headerRow) {
                 header.add(getCellValueAsString(cell));
             }
         }

         for (Row row : sheet) {
             List<String> rowData = new ArrayList<>();
             for (Cell cell : row) {
                 rowData.add(getCellValueAsString(cell));
             }
             data.add(rowData);
         }

         
         if (!data.isEmpty() && data.get(0).get(0).isEmpty()) {
             displayCheckbox = true;
         }
     } catch (IOException e) {
         e.printStackTrace();
         modelAndView.addObject("error", "Error reading the Excel file.");
         return modelAndView;
     }

     modelAndView.addObject("header", header);
     modelAndView.addObject("data", data);
     modelAndView.addObject("displayCheckbox", displayCheckbox);
     return modelAndView;
 }

 private String getCellValueAsString(Cell cell) {
     if (cell == null || cell.getCellType() == CellType.BLANK) {
         return "";
     } else if (cell.getCellType() == CellType.STRING) {
         return cell.getStringCellValue();
     } else if (cell.getCellType() == CellType.NUMERIC) {
         return String.valueOf(cell.getNumericCellValue());
     } else {
         return "";
     }
 }
}
