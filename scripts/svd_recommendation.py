# import sys
# import pandas as pd
# import numpy as np
# from scipy.sparse.linalg import svds

# # Đọc dữ liệu từ CSV
# input_file = sys.argv[1]
# df = pd.read_csv(input_file, index_col=0)

# # Đảm bảo tất cả các giá trị là số thực
# df = df.apply(pd.to_numeric, errors='coerce').fillna(0).astype(float)

# # Kiểm tra kích thước ma trận
# num_users, num_products = df.shape
# print(f"Number of users: {num_users}, Number of products: {num_products}")

# # Chọn giá trị k hợp lý
# k = min(num_users, num_products) - 1
# print(f"Using k={k} for SVD")

# # Áp dụng SVD
# U, sigma, Vt = svds(df.values, k=k)  # Chọn k yếu tố tiềm ẩn

# # Tạo ma trận dự đoán
# sigma = np.diag(sigma)
# predicted_ratings = np.dot(np.dot(U, sigma), Vt)

# # Chuyển đổi lại thành DataFrame
# predicted_df = pd.DataFrame(predicted_ratings, columns=df.columns, index=df.index)

# # Lưu kết quả
# output_file = input_file.replace('user_product_matrix.csv', 'predicted_ratings.csv')
# predicted_df.to_csv(output_file)

# print(f"Output file: {output_file}")  # Debug output




import sys
import pandas as pd
import numpy as np
from scipy.sparse.linalg import svds


input_file = sys.argv[1]
df = pd.read_csv(input_file, index_col=0)


df = df.astype(float)

# Xác định số lượng yếu tố tiềm ẩn k
num_users, num_products = df.shape
k = min(num_users - 1, num_products - 1)
# print(f"Number of users: {num_users}, Number of products: {num_products}")
# print(f"Using k={k} for SVD")

# Áp dụng SVD
U, sigma, Vt = svds(df.values, k=k)

# Tạo ma trận dự đoán
sigma = np.diag(sigma)
predicted_ratings = np.dot(np.dot(U, sigma), Vt)

# Chuyển đổi lại thành DataFrame
predicted_df = pd.DataFrame(predicted_ratings, columns=df.columns, index=df.index)

# Lưu kết quả
output_file = input_file.replace('matrandudoan.csv', 'ketquadudoan.csv')
predicted_df.to_csv(output_file)
print(f"Output file: {output_file}")
