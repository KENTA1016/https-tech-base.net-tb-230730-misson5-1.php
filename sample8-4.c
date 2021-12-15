#include <stdio.h>

int main(void){
	int i,j;
	int a[3][3]={0};		/*行列Aの各要素。とりあえず0で初期化*/
	int b[3][3]={0};		/*行列Bの各要素。とりあえず0で初期化*/
	int c[3][3]={0};		/*行列AとBの和、行列Cの各要素。とりあえず0で初期化*/

	/*行列Aの各要素を入力する*/
	printf("3行3列の行列Aの各要素を入力してください：\n");
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			printf("A[%d][%d]=",i+1,j+1);
			scanf("%d",&a[i][j]);
		}
		printf("\n");
	}

	/*行列Bの各要素を入力する*/
	printf("3行3列の行列Bの各要素を入力してください：\n");
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			printf("B[%d][%d]=",i+1,j+1);
			scanf("%d",&b[i][j]);
		}
		printf("\n");
	}

	/*画面上に行列Aを表示*/
	printf("行列A：\n");
	for (i = 0; i < 3; i++) {
		for (j = 0; j < 3; j++) {
			printf("%5d", a[i][j]);
		}
		printf("\n");
	}

	/*画面上に行列Bを表示*/
	printf("行列B：\n");
	for (i = 0; i < 3; i++) {
		for (j = 0; j < 3; j++) {
			printf("%5d", b[i][j]);
		}
		printf("\n");
	}

	/*行列AとBの和、行列Cの計算、画面上に行列Cを表示*/
	printf("行列AとBの積：\n");
	for (i = 0; i < 3; i++) {
		for (j = 0; j < 3; j++) {
			c[i][j] = a[i][j] * b[i][j];
			printf("%5d", c[i][j]);
		}
		printf("\n");
	}

	return(0);
}