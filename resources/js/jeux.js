function make2DArray(cols, rows) {
    let arr = new Array(cols);
    for (let i = 0; i < arr.length; i++) {
      arr[i] = new Array(rows);
    }
    return arr;
  }
  
  let grid;
  let w = 5;
  let rows, cols;
  let arr_Of_dotes = [];
  
  function setup() {
    createCanvas(400, 400);
    background(0);
    cols = width / w;
    rows = height / w;
    grid = make2DArray(cols, rows);
  
    for (let i = 0; i < cols; i++) {
      for (let y = 0; y < rows; y++) {
        grid[i][y] = 0;
      }
    }
  
    frameRate(60);
  }
  
  
  
  function firstcoloration(i,j){
    grid[i][j] = 1;
    
    let randoommm = round(random(1, 5));
    let color = [];
        switch (randoommm) {
            case 1:
              
              color.push(246, 167, 96);
             break;
             case 2:
          
            color.push(242, 210, 169);
             break;
             case 3:
            
            color.push(236, 204, 162);
             break;
             case 4:
         
            color.push(231, 196, 150);
             break;
             case 5:
      
            color.push(225, 191, 146);
             break;
             
        }
        fill(grid[i][j] * color[0], grid[i][j] * color[1], grid[i][j] * color[2]);
  
        let x = i * w;
        let y = j * w;
        square(x, y, w);
    return color;
        
  }
  function color_new_position(i,j,color){
    grid[i][j] = 1;
    fill(grid[i][j] * color[0], grid[i][j] * color[1], grid[i][j] * color[2]);
  
        let x = i * w;
        let y = j * w;
        square(x, y, w);
  }
  function Clear_color(i , j){
    grid[i][j] = 0;
    fill(grid[i][j] * 0, grid[i][j] * 0, grid[i][j] * 0);
          let x = i * w;
        let y = j * w;
        square(x, y, w);
  }
  function draw() {
    for (let i = 0; i < arr_Of_dotes.length; i++) {
      let x = arr_Of_dotes[i][0];
      let y = arr_Of_dotes[i][1];
      let color = arr_Of_dotes[i][2];
      let randomm = round(random(-1, 1));
    // sand
      // if(randomm >= -1 && randomm <= 1){
        if(x+randomm >= 0 && x+randomm < rows){
        
        if (grid[x+randomm ][y+1] == 0){
              arr_Of_dotes[i] = [x+randomm , y+1,color];
              Clear_color(x,y);
              color_new_position(x+randomm , y+1, color);
        }else if (grid[x+randomm][y+1] == 1){
          color_new_position(x , y, color);
            }
  
         }
      // }
      
    // water
    // if(x+randomm >= 0 && x+randomm < rows){
    //     if (grid[x+randomm][y+1] == 0 ){
    //           arr_Of_dotes[i] = [x+randomm , y+1,color];
    //           Clear_color(x,y);
    //           color_new_position(x+randomm , y+1, color);
    //     }else if(grid[x+randomm][y+0] == 0){
    //           arr_Of_dotes[i] = [x+randomm , y+0,color];
    //           Clear_color(x,y);
    //           color_new_position(x+randomm , y+0, color);
    //     }else if (grid[x+randomm][y+1] == 1){
    //       color_new_position(x , y, color);
    //         }
    //      }
  
  }
  
  
  }
  
  function mouseDragged() {
    hh();
  }
  
  function mousePressed() {
    hh();
  }
  
  function hh() {
    let x = floor(mouseX / w);
    let y = floor(mouseY / w);
  
      
      for (let i = 0 ; i < 5 ; i++){
        for (let j = 0 ; j < 5 ; j++){
          if(x + i < rows && x +i >= 0 && y + j >=0 && y + j <=cols){
            if(grid[x +i][y + j] == 0){
            
              let color = firstcoloration(x + i,y + j);
              arr_Of_dotes.push([x + i, y + j , color]);
          }
        }
      }
    }
  }