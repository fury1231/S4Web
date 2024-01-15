import os

# 指定图像文件夹路径
image_folder = "E:\resources\a"

# 获取文件夹中所有的文件
image_files = sorted([f for f in os.listdir(image_folder) if f.endswith('.jpg')], reverse=True)

# 重新命名并保存，从120开始
start_index = 120
for i, old_name in enumerate(image_files, start=start_index):
    # 构建新的文件名
    new_name = f"{i}.jpg"
    
    # 构建文件的完整路径
    old_path = os.path.join(image_folder, old_name)
    new_path = os.path.join(image_folder, new_name)
    
    # 重命名文件
    os.rename(old_path, new_path)
    
    print(f"Renamed: {old_name} -> {new_name}")
